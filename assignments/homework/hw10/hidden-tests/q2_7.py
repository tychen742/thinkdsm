#chatgpt

from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name  = "q2_7"
points = 5


# ---- 2 pts: visible basic check ----
@test_case(points=2, hidden=True)
def test_q2_7_visible(rmse):
    """
    rmse(0, 0) should return a finite, non‑negative number.
    """
    val = rmse(0, 0)
    assert isinstance(val, numbers.Real)
    assert np.isfinite(val) and val >= 0


# ---- 3 pts: hidden robustness check ----
@test_case(points=3, hidden=True)
def test_q2_7_hidden(rmse):
    """
    Call rmse on two different (slope, intercept) pairs.
    • Each result must be finite & ≥ 0.
    • At least one of the results must differ, showing slope/intercept
      actually affect the calculation.
    """
    out1 = rmse(1, 1)
    out2 = rmse(-2, 5)

    for v in (out1, out2):
        assert isinstance(v, numbers.Real)
        assert np.isfinite(v) and v >= 0

    # It’s possible (but extremely unlikely) that both calls give the
    # exact same RMSE.  Guard against that edge case with a tiny tolerance.
    assert not np.isclose(out1, out2, rtol=1e-12, atol=1e-12), (
        "rmse should change when slope/intercept change."
    )
