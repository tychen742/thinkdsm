from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name  = "q2_11"
points = 5



@test_case(points=1.5, hidden=False)
def test_q2_11_contains_1(scoring_array):
    assert 1 in list(scoring_array), "`scoring_array` must include option 1."



@test_case(points=1.5, hidden=False)
def test_q2_11_contains_3(scoring_array):
    assert 3 in list(scoring_array), "`scoring_array` must include option 3."



@test_case(points=2, hidden=True)
def test_q2_11_exact(scoring_array):
    target = np.array([1, 3])
    assert np.array_equal(scoring_array, target), (
        "`scoring_array` must be exactly make_array(1, 3) to earn the final point."
    )
