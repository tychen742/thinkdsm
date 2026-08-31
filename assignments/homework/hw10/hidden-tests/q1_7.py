from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_7"
points = 5


# ---- 2 pt: visible simple line (intercept 2) ----
@test_case(points=2, hidden=True)
def test_q1_7_visible(intercept):
    x = np.array([0, 1, 2])
    y = np.array([2, 5, 8])   # y = 3x + 2 ⇒ intercept 2
    assert np.isclose(intercept(x, y), 2)


# ---- 2+1 pts: hidden random linear data ----
@test_case(points=3, hidden=True)
def test_q1_7_hidden(intercept, slope):
    rng = np.random.default_rng(7)
    x = rng.normal(size=400)
    true_b = -4.3
    true_m = 0.8
    y = true_m * x + true_b + rng.normal(scale=0.01, size=400)

    # check intercept close to true_b and consistent with slope
    b_hat = intercept(x, y)
    m_hat = slope(x, y)
    assert np.isclose(b_hat, true_b, atol=1e-2)
    # also make sure predicted line passes near mean point
    assert np.isclose(np.mean(y), m_hat * np.mean(x) + b_hat, atol=1e-6)
