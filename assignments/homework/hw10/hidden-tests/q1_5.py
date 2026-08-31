from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_5"
points = 5


@test_case(points=2, hidden=True)
def test_q1_5_visible(slope):
    """
    y = 2x  ⇒  slope should be 2
    """
    x = np.array([1, 2, 3])
    y = np.array([2, 4, 6])
    assert np.isclose(slope(x, y), 2)


@test_case(points=3, hidden=True)
def test_q1_5_hidden(slope):
    rng = np.random.default_rng(2025)
    x = rng.normal(size=300)
    true_b = 1.7
    y = true_b * x + rng.normal(scale=0.01, size=300)  # tiny noise
    assert np.isclose(slope(x, y), true_b, atol=1e-2)
