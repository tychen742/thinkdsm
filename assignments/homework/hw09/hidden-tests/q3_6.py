from otter.test_files import test_case
import numbers, numpy as np, math

OK_FORMAT = False
name = "q3_6"
points = 7

P_HAT   = 210 / 400          # 0.525
POP_SD  = math.sqrt(P_HAT * (1 - P_HAT))           #  0.49997
TARGET  = POP_SD / math.sqrt(9975)                 #  0.00500



@test_case(points=7, hidden=True)
def test_q3_6_value(michelle_sample_mean_sd):
    assert np.isclose(michelle_sample_mean_sd, TARGET, atol=5e-4, rtol=0.05), \
        (f"Expected about {TARGET:.5f}, got {michelle_sample_mean_sd}.")
