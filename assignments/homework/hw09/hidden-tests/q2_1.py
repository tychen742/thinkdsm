
from otter.test_files import test_case
import numbers, numpy as np

OK_FORMAT = False
name = "q2_1"
points = 5 

@test_case(points=5, hidden=True)
def test_q2_1_smallest(smallest):
    """
    `smallest` should be the (decimal) sample size needed for a
    95 % confidence interval whose full width is ≤ 6 %.
    The expected value is (2 / 0.06)**2 ≈ 1111.1111.
    We allow a small absolute / relative tolerance.
    """
    
    target = (2 / 0.06) ** 2            
    assert np.isclose(
        smallest, target, atol=1e-2, rtol=1e-3
    ), f"`smallest` should be about {target:.4f} (within tolerance)."
