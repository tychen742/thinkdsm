from otter.test_files import test_case
import numpy as np, numbers          

OK_FORMAT = False
name = "q1_2"
points = 5



@test_case(points=0.75, hidden=True)
def test_q1_2_contains_2(standard_array):
    assert 2 in list(standard_array), "`standard_array` must contain 2."



@test_case(points=0.75, hidden=True)
def test_q1_2_contains_3(standard_array):
    assert 3 in list(standard_array), "`standard_array` must contain 3."



@test_case(points=0.75, hidden=True)
def test_q1_2_contains_4(standard_array):
    assert 4 in list(standard_array), "`standard_array` must contain 4."


@test_case(points=0.75, hidden=True)
def test_q1_2_contains_5(standard_array):
    assert 5 in list(standard_array), "`standard_array` must contain 5."



@test_case(points=2, hidden=True)
def test_q1_2_exact_order(standard_array):
    target = np.array([2, 3, 4, 5])
    assert np.array_equal(standard_array, target), (
        "`standard_array` must be exactly [2, 3, 4, 5] in that order "
        "to earn the final 2 points."
    )
