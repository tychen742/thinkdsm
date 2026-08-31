#chatgpt

from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_3"
points = 5


@test_case(points=2.5, hidden=True)
def test_q1_3_visible(correlation):
    """
    Perfect linear relationship should give correlation ≈ 1.
    """
    assert np.isclose(
        correlation(np.array([1, 2, 3]), np.array([4, 5, 6])), 1
    )


@test_case(points=2.5, hidden=True)
def test_q1_3_hidden(correlation):
    """
    Compare against numpy.corrcoef on random data; also checks symmetry
    and self‑correlation equals 1.
    """
    rng = np.random.default_rng(123)
    x = rng.normal(size=250)
    y = 3 * x + rng.normal(scale=0.2, size=250)

    ours = correlation(x, y)
    truth = np.corrcoef(x, y)[0, 1]
    assert np.isclose(ours, truth, atol=1e-3)

    # symmetry
    assert np.isclose(correlation(x, y), correlation(y, x), atol=1e-10)

    # self‑correlation
    assert np.isclose(correlation(x, x), 1)
