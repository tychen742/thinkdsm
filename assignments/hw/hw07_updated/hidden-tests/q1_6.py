from otter.test_files import test_case

OK_FORMAT = False
name = "q1_6"
points = 4

@test_case(points=4, hidden=True)
def test_q1_6(assumption_needed):
    assert assumption_needed == 1, f"Expected 1, but got {assumption_needed}"
