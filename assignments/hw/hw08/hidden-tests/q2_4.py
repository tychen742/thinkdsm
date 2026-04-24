from otter.test_files import test_case

OK_FORMAT = False
name = "q2_4"
points = 0.75


@test_case(points=0.75, hidden=True)
def test_q2_4(cutoff_one_percent):
    """
    Check that the student set cutoff_one_percent correctly.
    """
    assert cutoff_one_percent == 3, (
        f"Expected cutoff_one_percent to be 3 (unable to tell), but got {cutoff_one_percent}"
    )
