# from otter.test_files import test_case
# import numpy as np

# OK_FORMAT = False
# name = "q2_2"
# points = 1

# @test_case(points=1, hidden=True)
# def test_q2_2_tvd_value(observed_tvd):
#     expected_value = 0.38791256366666665
#     assert np.isclose(observed_tvd, expected_value, atol=1e-5), f"Expected {expected_value}, but got {observed_tvd}"

from otter.test_files import test_case
import numpy as np
from datascience import Table

OK_FORMAT = False
name = "q2_2"
points = 4


us_happiness_factors = Table.read_table("us_happiness_factors.csv")
obs_dist = us_happiness_factors.column("Proportion of Happiness Score")
null_dist = np.full(len(obs_dist), 1/len(obs_dist))   # [1/6, 1/6, …]

###########################################################
# 1. Functional test: calculate_tvd works on toy example
###########################################################
@test_case(points=2, hidden=True)
def test_q2_2_function(calculate_tvd):
    # Toy observed & null distributions
    toy_obs  = np.array([0.4, 0.6])
    toy_null = np.array([0.5, 0.5])
    expected_toy = np.sum(np.abs(toy_obs - toy_null)) / 2   # should be 0.1
    result = calculate_tvd(toy_obs, toy_null)
    assert isinstance(result, (float, np.floating)), "calculate_tvd should return a number."
    assert np.isclose(result, expected_toy, atol=1e-6), (
        f"calculate_tvd returned {result}, but expected {expected_toy} on the toy input."
    )

#################################################################
# 2. Notebook consistency: observed_tvd matches recomputed value
#################################################################
@test_case(points=2, hidden=True)
def test_q2_2_observed(calculate_tvd, observed_tvd):
    expected = calculate_tvd(obs_dist, null_dist)
    assert np.isclose(observed_tvd, expected, atol=1e-6), (
        f"observed_tvd = {observed_tvd}, but should be {expected} "
        "(recomputed from us_happiness_factors and equal-null distribution)."
    )

