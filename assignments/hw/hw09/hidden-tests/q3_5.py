#
# We multiply the standard error by z = 1.96.

#
# With p = 210/400 = 0.525 and  n = 400,
#     SE = sqrt(p(1-p)/n) ≈ 0.02497
#     margin with 1.96  → 0.0489
#     margin with 2.00  → 0.0499
# We allow ±0.005 atol to cover rounding.

from otter.test_files import test_case
import numbers, numpy as np

OK_FORMAT = False
name   = "q3_5"
points = 7

SAMPLE_P = 210 / 400          
SE       = np.sqrt(SAMPLE_P * (1 - SAMPLE_P) / 400)

   
@test_case(points=2, hidden=True)
def test_q3_5_bounds(lower_limit, upper_limit):
    assert 0 <= lower_limit < SAMPLE_P < upper_limit <= 1, \
        "Limits must lie in [0, 1]."

@test_case(points=5, hidden=True)
def test_q3_5_margins(lower_limit, upper_limit):
    margin_lower = SAMPLE_P - lower_limit
    margin_upper = upper_limit - SAMPLE_P
    min_margin = 1.96 * SE - 0.005        # ≈ 0.044
    max_margin = 2.00 * SE + 0.005        # ≈ 0.055
    assert min_margin <= margin_lower <= max_margin, \
        f"Lower margin {margin_lower:.4f} out of acceptable range."
    assert min_margin <= margin_upper <= max_margin, \
        f"Upper margin {margin_upper:.4f} out of acceptable range."
    