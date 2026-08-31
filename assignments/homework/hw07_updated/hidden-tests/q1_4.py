from otter.test_files import test_case

OK_FORMAT = False
name = "q1_4"
points = 4

@test_case(points=4, hidden=True)
def test_q1_4(valid_test_stat):
    valid_choices = [1, 2]
    assert valid_test_stat in valid_choices, \
        f"Expected valid_test_stat to be one of {valid_choices}, but got {valid_test_stat}"
