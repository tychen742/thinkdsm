from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q1_1"
points = 4

@test_case(points=2, hidden=True)
def test_q1_1_sample_size(sample_size, percent_V1):
    expected_sample_size = 318
    assert sample_size == expected_sample_size, f"Expected sample size {expected_sample_size}, but got {sample_size}"

@test_case(points=2, hidden=True)
def test_q1_1_percentage(sample_size, percent_V1):
    expected_percent = 66.35220125786164
    assert np.isclose(percent_V1, expected_percent, atol=1e-3), \
        f"Expected percent_V1 approximately {expected_percent}, but got {percent_V1}"
