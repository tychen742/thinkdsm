from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q1_5"
points = 4

@test_case(points=4, hidden=True)
def test_q1_5(observed_statistic, percent_V1):
    """
    Accept either:
      • signed difference:  percent_V1 - 60   (option 1)
      • absolute difference: |percent_V1 - 60| (option 2)
    """
    signed = percent_V1 - 60
    absolute = abs(signed)

    assert np.isclose(observed_statistic, signed, atol=1e-3) \
        or np.isclose(observed_statistic, absolute, atol=1e-3), (
        "observed_statistic should be either (percent_V1 - 60) or its absolute value "
        f"(±0.001). Got {observed_statistic:.6f}."
    )
