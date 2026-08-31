from otter.test_files import test_case

OK_FORMAT = False
name = "q2_5"
points = 5 

@test_case(points=5, hidden=True)
def test_q2_5_option(option):
    """
    For ±2.33 SDs the confidence level is 98 %, which was option 4.
    """
    expected = 4
    assert option == expected, (
        f"Expected option {expected} (98 % confidence), "
        f"but got {option}."
    )
