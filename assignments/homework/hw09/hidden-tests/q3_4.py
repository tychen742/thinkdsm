
from otter.test_files import test_case
import numbers, numpy as np

OK_FORMAT = False
name  = "q3_4"
points = 7


@test_case(points=7, hidden=True)
def test_q3_4_exact_sd(exact_sd, resample_yes_proportions):


    target = resample_yes_proportions.std()

    # Absolute tolerance 5e-4 ≈ 2 % of 0.025

    assert np.isclose(exact_sd, target, atol=5e-3), \
        (f"Expected {target:.5f} from np.std(resample_yes_proportions), "
         f"but got {exact_sd}.")
