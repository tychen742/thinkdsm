from otter.test_files import test_case
import numbers, numpy as np

OK_FORMAT = False
name = "q3_1"
points = 8    

@test_case(points=2, hidden=True)
def test_q3_1_structure(resample_yes_proportions):
    assert isinstance(resample_yes_proportions, (list, tuple, np.ndarray)), \
        "`resample_yes_proportions` must be array-like."
    resample_yes_proportions = np.asarray(resample_yes_proportions)
    assert len(resample_yes_proportions) == 10_000, \
        "Expected 10 000 bootstrap resamples."

@test_case(points=2, hidden=True)
def test_q3_1_bounds(resample_yes_proportions):
    resample_yes_proportions = np.asarray(resample_yes_proportions)
    assert np.all((0 <= resample_yes_proportions) & (resample_yes_proportions <= 1)), \
        "All proportions must be between 0 and 1."
    
@test_case(points=4, hidden=True)
def test_q3_1_moments(resample_yes_proportions):
    resample_yes_proportions = np.asarray(resample_yes_proportions)
    mean = resample_yes_proportions.mean()
    std  = resample_yes_proportions.std()
    assert abs(mean - 0.525) < 0.025, \
        f"Mean of resamples should be near 0.525, but got {mean:.3f}."
    assert 0.010 < std < 0.05, \
        f"Standard deviation should be about 0.025; got {std:.3f}."