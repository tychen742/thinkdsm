from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_8"
points = 5   



@test_case(points=1.5, hidden=True)
def test_q1_8_contains_1(intercept_array):
    assert 1 in list(intercept_array), "`intercept_array` must include option 1."



@test_case(points=1.5, hidden=True)
def test_q1_8_contains_4(intercept_array):
    assert 4 in list(intercept_array), "`intercept_array` must include option 4."



@test_case(points=2, hidden=True)
def test_q1_8_exact_order(intercept_array):
    target = np.array([1, 4])
    assert np.array_equal(intercept_array, target) and len(intercept_array) == 2, (
        "`intercept_array` must be exactly [1, 4] (and include nothing else) to earn full credit."
    )
