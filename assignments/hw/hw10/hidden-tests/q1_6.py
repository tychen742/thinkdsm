from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_6"
points = 5   



@test_case(points=1, hidden=True)
def test_q1_6_contains_2(slope_array):
    assert 2 in list(slope_array), "`slope_array` must include option 2."



@test_case(points=1, hidden=True)
def test_q1_6_contains_4(slope_array):
    assert 4 in list(slope_array), "`slope_array` must include option 4."



@test_case(points=1, hidden=True)
def test_q1_6_contains_5(slope_array):
    assert 5 in list(slope_array), "`slope_array` must include option 5."



@test_case(points=2, hidden=True)
def test_q1_6_exact_order(slope_array):
    target = np.array([2, 4, 5])
    assert np.array_equal(slope_array, target) and 1 not in list(slope_array) and 3 not in list(slope_array), (
        "`slope_array` must be exactly [2, 4, 5] (and not include 1 or 3) to earn the final 2 points."
    )
