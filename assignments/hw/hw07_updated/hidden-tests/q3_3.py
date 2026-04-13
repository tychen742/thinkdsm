from otter.test_files import test_case

OK_FORMAT = False
name = "q3_3"
points = 4

@test_case(points=2, hidden=True)
def test_q3_3_null(null_statement_number):
    """
    Null hypothesis must be statement 2.
    """
    assert null_statement_number == 2, (
        f"null_statement_number should be 2, not {null_statement_number}."
    )


@test_case(points=2, hidden=True)
def test_q3_3_alt(alternative_statement_number):
    """
    Alternative can be 5 (directional) or 6 (any difference).
    """
    assert alternative_statement_number in {5, 6}, (
        "alternative_statement_number must be 5 or 6 "
        f"(got {alternative_statement_number})."
    )