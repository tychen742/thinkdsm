from otter.test_files import test_case
import numbers, numpy as np, math

OK_FORMAT = False
name = "q3_7"
points = 7

P_HAT  = 0.525
POP_SD = math.sqrt(P_HAT * (1 - P_HAT))            # ≈ 0.49997
MICHELLE_N  = 9975

@test_case(points=2, hidden=True)
def test_q3_7_sizes(smaller_sample_size, michelle_sample_size=MICHELLE_N):
    assert isinstance(smaller_sample_size, numbers.Number),                 \
        "`smaller_sample_size` must be numeric."
    assert 0 < smaller_sample_size < michelle_sample_size,                  \
        "`smaller_sample_size` should be a positive integer < 9 975."

@test_case(points=5, hidden=True)
def test_q3_7_sd(smaller_sample_size, smaller_sample_mean_sd,
                 michelle_sample_mean_sd):
    target = POP_SD / math.sqrt(smaller_sample_size)
    # value must match theory …
    assert np.isclose(smaller_sample_mean_sd, target, atol=5e-4, rtol=0.05),\
        "Computed SD doesn’t match formula."
    # … and be larger than Michelle’s SE
    assert smaller_sample_mean_sd > michelle_sample_mean_sd + 1e-4, \
        "SD should be larger than Michelle’s (bigger SE for smaller n)."
