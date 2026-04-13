#chatgpt

from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q2_3"
points = 4

#############################################
# 1. Structure: length and numeric entries  #
#############################################
@test_case(points=2, hidden=True)
def test_q2_3_structure(simulated_tvds):
    assert isinstance(simulated_tvds, np.ndarray), (
        "simulated_tvds should be a NumPy array."
    )
    assert simulated_tvds.shape == (10000,), (
        f"simulated_tvds must contain exactly 10 000 values; "
        f"found shape {simulated_tvds.shape}."
    )
    assert np.all(np.isfinite(simulated_tvds)), (
        "simulated_tvds contains NaN or infinite values."
    )
    # TVD is always non-negative and ≤ 1
    assert np.all((simulated_tvds >= 0) & (simulated_tvds <= 1)), (
        "All TVD values should be between 0 and 1."
    )

#############################################
# 2. Reasonableness: distribution check     #
#############################################
@test_case(points=2, hidden=True)
def test_q2_3_reasonable(simulated_tvds):
    """
    The simulated TVDs should have some spread:
      • mean should be well below 0.2 (expected under null for 6 equiprobable
        categories with n=1000 is ≈ 0.08)
      • standard deviation should be > 0.015 so the array isn't full of zeros.
    These loose thresholds accommodate random variation while still
    catching major errors (e.g., forgetting to divide by 2, or appending
    the wrong thing).
    """
    mean_val = np.mean(simulated_tvds)
    std_val  = np.std(simulated_tvds)

    assert 0 < mean_val < 0.25, (
        f"The mean of simulated_tvds ({mean_val:.4f}) is out of a plausible range "
        "(should be well below 0.2 for this null model)."
    )
    assert std_val > 0.005, (
        f"The standard deviation of simulated_tvds ({std_val:.4f}) is too small; "
        "the array may be constant or built incorrectly."
    )
