"""Custom citation style with round brackets for APA-like formatting."""
from dataclasses import dataclass, field
import sphinxcontrib.bibtex.plugin

from sphinxcontrib.bibtex.style.referencing import BracketStyle
from sphinxcontrib.bibtex.style.referencing.author_year import AuthorYearReferenceStyle


def bracket_style() -> BracketStyle:
    return BracketStyle(
        left='(',
        right=')',
    )


@dataclass
class AuthorYearRoundReferenceStyle(AuthorYearReferenceStyle):
    """Author-year citation style with round brackets (parentheses)."""
    bracket_parenthetical: BracketStyle = field(default_factory=bracket_style)
    bracket_textual: BracketStyle = field(default_factory=bracket_style)
    bracket_author: BracketStyle = field(default_factory=bracket_style)
    bracket_label: BracketStyle = field(default_factory=bracket_style)
    bracket_year: BracketStyle = field(default_factory=bracket_style)


sphinxcontrib.bibtex.plugin.register_plugin(
    'sphinxcontrib.bibtex.style.referencing',
    'author_year_round',
    AuthorYearRoundReferenceStyle
)


def setup(app):
    """Sphinx extension setup function."""
    return {
        'version': '0.1',
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }
