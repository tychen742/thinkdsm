"""Reset appendix chapter numbering while preserving continuous main chapters."""

from typing import Dict, List, Set, Tuple, cast

from docutils import nodes
from docutils.nodes import Element
from sphinx import addnodes
from sphinx.environment import BuildEnvironment
from sphinx.environment.collectors.toctree import TocTreeCollector
from sphinx.locale import __
from sphinx.util import logging, url_re

logger = logging.getLogger(__name__)


def assign_section_numbers(self, env: BuildEnvironment) -> List[str]:
    """Assign section numbers, restarting at the appendices toctree."""
    rewrite_needed = []

    assigned: Set[str] = set()
    old_secnumbers = env.toc_secnumbers
    env.toc_secnumbers = {}
    self.last_chapter_number = 0

    def _walk_toc(
        node: Element, secnums: Dict, depth: int, titlenode: nodes.title = None
    ) -> None:
        for subnode in node.children:
            if isinstance(subnode, nodes.bullet_list):
                numstack.append(0)
                _walk_toc(subnode, secnums, depth - 1, titlenode)
                numstack.pop()
                titlenode = None
            elif isinstance(subnode, nodes.list_item):
                _walk_toc(subnode, secnums, depth, titlenode)
                titlenode = None
            elif isinstance(subnode, addnodes.only):
                _walk_toc(subnode, secnums, depth, titlenode)
                titlenode = None
            elif isinstance(subnode, addnodes.compact_paragraph):
                numstack[-1] += 1
                reference = cast(nodes.reference, subnode[0])

                if len(numstack) == 1:
                    self.last_chapter_number += 1
                if depth > 0:
                    number = list(numstack)
                    secnums[reference["anchorname"]] = tuple(numstack)
                else:
                    number = None
                    secnums[reference["anchorname"]] = None
                reference["secnumber"] = number
                if titlenode:
                    titlenode["secnumber"] = number
                    titlenode = None
            elif isinstance(subnode, addnodes.toctree):
                _walk_toctree(subnode, depth)

    def _walk_toctree(toctreenode: addnodes.toctree, depth: int) -> None:
        if depth == 0:
            return
        for title, ref in toctreenode["entries"]:
            if url_re.match(ref) or ref == "self":
                continue
            if ref in assigned:
                logger.warning(
                    __(
                        "%s is already assigned section numbers "
                        "(nested numbered toctree?)"
                    ),
                    ref,
                    location=toctreenode,
                    type="toc",
                    subtype="secnum",
                )
            elif ref in env.tocs:
                secnums: Dict[str, Tuple[int, ...]] = {}
                env.toc_secnumbers[ref] = secnums
                assigned.add(ref)
                _walk_toc(env.tocs[ref], secnums, depth, env.titles.get(ref))
                if secnums != old_secnumbers.get(ref):
                    rewrite_needed.append(ref)

    numbered_toctrees = [toc for toc in env.tocs if toc in env.numbered_toctrees]

    for docname in numbered_toctrees:
        assigned.add(docname)
        doctree = env.get_doctree(docname)
        for toctreenode in doctree.traverse(addnodes.toctree):
            depth = toctreenode.get("numbered", 0)
            if depth:
                if toctreenode.get("caption") == "Appendices":
                    self.last_chapter_number = 0
                numstack = [self.last_chapter_number]
                _walk_toctree(toctreenode, depth)

    return rewrite_needed


def patch_numbering(app):
    TocTreeCollector.assign_section_numbers = assign_section_numbers


def setup(app):
    app.connect("builder-inited", patch_numbering, priority=1000)

    return {
        "version": "0.1",
        "parallel_read_safe": True,
        "parallel_write_safe": True,
    }
