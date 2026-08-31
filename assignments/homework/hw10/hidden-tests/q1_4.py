from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_4"
points = 5



@test_case(points=0.75, hidden=True)
def test_q1_4_contains_1(r_array):
    assert 1 in list(r_array), "`r_array` must include option 1."



@test_case(points=0.75, hidden=True)
def test_q1_4_contains_2(r_array):
    assert 2 in list(r_array), "`r_array` must include option 2."



@test_case(points=0.75, hidden=True)
def test_q1_4_contains_3(r_array):
    assert 3 in list(r_array), "`r_array` must include option 3."



@test_case(points=0.75, hidden=True)
def test_q1_4_contains_4(r_array):
    assert 4 in list(r_array), "`r_array` must include option 4."



@test_case(points=2, hidden=True)
def test_q1_4_exact_order(r_array):
    target = np.array([1, 2, 3, 4])
    assert np.array_equal(r_array, target) and 5 not in list(r_array), (
        "`r_array` must be exactly [1, 2, 3, 4] (and not include 5) to earn the final 2 points."
    )
