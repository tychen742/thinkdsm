from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name  = "q2_10"
points = 5



@test_case(points=1.5, hidden=False)
def test_q2_10_contains_2(error_array):
    assert 2 in list(error_array), "`error_array` must include option 2."



@test_case(points=1.5, hidden=False)
def test_q2_10_contains_4(error_array):
    assert 4 in list(error_array), "`error_array` must include option 4."



@test_case(points=2, hidden=True)
def test_q2_10_exact(error_array):
    target = np.array([2, 4])
    assert np.array_equal(error_array, target), (
        "`error_array` must be exactly make_array(2, 4) to earn the final point."
    )
