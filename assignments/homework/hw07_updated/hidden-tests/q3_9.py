from otter.test_files import test_case
import numpy as np
from datascience import Table

OK_FORMAT = False
name = "q3_9"
points = 4  

sampled_ages = Table.read_table("age.csv")
true_n = sampled_ages.num_rows

########################################
# 1.  Basic validity (0.5 pt)          #
########################################
@test_case(points=2, hidden=True)
def test_q3_9_basic(simulate_one_statistic):
    """
    • Function must take no arguments
    • Return a finite numeric value each call
    • Value should be in a plausible age-difference range (±25)
    """
    val = simulate_one_statistic()
    assert isinstance(val, (float, np.floating, int, np.integer)), (
        "simulate_one_statistic must return a number."
    )
    assert np.isfinite(val), "Returned value is not finite."
    # Ages in the data lie roughly between 18 and 80, so differences must live in ±25
    assert -25 <= val <= 25, (
        f"Returned value {val} is outside a plausible range for a difference of means."
    )

########################################
# 2.  Must involve genuine shuffling (0.5 pt)
########################################
@test_case(points=2, hidden=True)
def test_q3_9_shuffle(simulate_one_statistic):
    """
    Call the function 10 times; values should not be (almost) all identical.
    That would indicate the labels were not being reshuffled.
    """
    vals = np.array([simulate_one_statistic() for _ in range(10)])
    unique_vals = np.unique(np.round(vals, 6))   # round to avoid fp duplicates
    # With proper random shuffling we expect multiple different outcomes
    assert len(unique_vals) > 2, (
        "simulate_one_statistic appears to return the same value each time – "
        "it should reshuffle the labels on every call."
    )
