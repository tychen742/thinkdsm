from otter.test_files import test_case

OK_FORMAT = False
name = "q2_2"
points = 0.75

@test_case(points=0.75, hidden=True)
def test_q2_2_true_intervals(true_percentage_intervals):
    # For 95% of 6000 intervals
    expected = 0.95 * 6000
    assert true_percentage_intervals == expected, \
        f"Expected true_percentage_intervals to be {expected}, but got {true_percentage_intervals}"
