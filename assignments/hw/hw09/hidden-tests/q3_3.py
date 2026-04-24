
from otter.test_files import test_case
import math, numpy as np

OK_FORMAT = False
name  = "q3_3"
points = 7


# Theoretical target: sqrt[p(1-p)/n] where p = 210 / 400 = 0.525, n = 400
# => 0.0249687…
# allowing ±1e-3 absolute and 5 % relative tolerance (covers rounding / p=0.526 etc.)

TARGET = math.sqrt(0.525 * 0.475 / 400)

@test_case(points=7, hidden=True)
def test_q3_3_approx_sd(approximate_sd):
   
    assert np.isclose(approximate_sd, TARGET, atol=1e-3, rtol=5e-2), \
        (f"Expected about {TARGET:.5f}, but got {approximate_sd}.")
