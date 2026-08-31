from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name = "q1_1"
points = 5


@test_case(points=2.5, hidden=True)
def test_q1_1_visible(standard_units):
    """
    Basic sanity‑check on a short array.
    Mean should be ~0 and std ~1 after conversion.
    """
    su = standard_units(np.array([1, 2, 3, 4, 5]))
    assert np.isclose(np.mean(su), 0, atol=1e-8)
    assert np.isclose(np.std(su), 1, atol=1e-8)


@test_case(points=2.5, hidden=True)
def test_q1_1_hidden(standard_units):
    """
    Robust check on random normal data.
    """
    rng = np.random.default_rng(42)
    arr = rng.normal(loc=10, scale=5, size=1000)
    su = standard_units(arr)
    assert np.isclose(np.mean(su), 0, atol=1e-8)
    assert np.isclose(np.std(su), 1, atol=1e-8)
