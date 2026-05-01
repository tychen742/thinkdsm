from otter.test_files import test_case
import numpy as np, numbers

from datascience import *



OK_FORMAT = False
name = "q1_9"
points = 5


# ---- 2 pts: visible deterministic check ----
@test_case(points=2, hidden=True)
def test_q1_9_visible(predict):
    """
    Simple line: y = 2x + 1 on 3 points.
    """
  
    x = np.array([0, 1, 2])
    y = 2 * x + 1
    tbl = Table().with_columns("col1", x, "col2", y)
    assert np.allclose(predict(tbl, "col1", "col2"), y)


# ---- 3 pts: hidden random linear data ----
@test_case(points=3, hidden=True)
def test_q1_9_hidden(predict, slope, intercept):
    """
    Random slope/intercept with small noise; compare predictions to
    true y values and check MSE is tiny.
    """
    
    rng = np.random.default_rng(2025)
    x = rng.normal(size=500)
    true_m, true_b = 0.73, -2.5
    noise = rng.normal(scale=0.05, size=500)
    y = true_m * x + true_b + noise

    tbl = Table().with_columns("col1", x, "col2", y)

    preds = predict(tbl, "col1", "col2")
    # Ensure predictions are numeric & same length
    assert isinstance(preds, np.ndarray) and preds.shape == y.shape

    # Check that predictions closely approximate actual y (MSE very small)
    mse = np.mean((preds - y) ** 2)
    assert mse < 0.01

    # Also verify internal consistency with slope()/intercept() helpers
    m_hat = slope(x, y)
    b_hat = intercept(x, y)
    assert np.allclose(preds, m_hat * x + b_hat)
