import ast
import contextlib
import io
import json
import sys


ALLOWED_CALLS = {
    "print": print,
    "int": int,
    "round": round,
    "ord": ord,
    "bin": bin,
    "hex": hex,
    "str": str,
    "float": float,
}

ALLOWED_NODES = (
    ast.Module,
    ast.Assign,
    ast.Expr,
    ast.Name,
    ast.Load,
    ast.Store,
    ast.Constant,
    ast.BinOp,
    ast.Add,
    ast.Sub,
    ast.Mult,
    ast.Div,
    ast.FloorDiv,
    ast.Mod,
    ast.Pow,
    ast.UnaryOp,
    ast.UAdd,
    ast.USub,
    ast.Call,
    ast.keyword,
    ast.JoinedStr,
    ast.FormattedValue,
)


class LabCodeValidator(ast.NodeVisitor):
    def generic_visit(self, node):
        if not isinstance(node, ALLOWED_NODES):
            raise ValueError(f"{type(node).__name__} is not allowed in this lab.")
        super().generic_visit(node)

    def visit_Name(self, node):
        if node.id.startswith("__"):
            raise ValueError("Names beginning with __ are not allowed.")
        self.generic_visit(node)

    def visit_Call(self, node):
        if not isinstance(node.func, ast.Name) or node.func.id not in ALLOWED_CALLS:
            raise ValueError("Only the allowed Chapter 1 functions can be called.")
        self.generic_visit(node)


def run_code(code):
    tree = ast.parse(code, mode="exec")
    LabCodeValidator().visit(tree)
    compiled = compile(tree, "<student-code>", "exec")
    stdout = io.StringIO()
    safe_globals = {"__builtins__": ALLOWED_CALLS}
    with contextlib.redirect_stdout(stdout):
        exec(compiled, safe_globals, {})
    return stdout.getvalue()


def main():
    try:
        payload = json.loads(sys.stdin.read() or "{}")
        code = str(payload.get("code", ""))
        output = run_code(code)
        print(json.dumps({"ok": True, "stdout": output, "stderr": "", "error": None}))
    except Exception as exc:
        print(json.dumps({"ok": False, "stdout": "", "stderr": "", "error": str(exc)}))


if __name__ == "__main__":
    main()
