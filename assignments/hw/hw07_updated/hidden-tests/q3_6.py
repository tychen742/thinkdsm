from otter.test_files import test_case
import numpy as np
from datascience import Table

OK_FORMAT = False
name = "q3_6"
points = 4

@test_case(points=4, hidden=True)
def test_q3_6(observed_statistic_ab):
    """
    observed_statistic_ab should be the ABSOLUTE difference between
    the mean ages of males and females in sampled_ages.
    """
    sampled_ages = Table.read_table("age.csv")

    male_mean   = sampled_ages.where("Gender", "male").column("Age").mean()
    female_mean = sampled_ages.where("Gender", "female").column("Age").mean()
    expected    = abs(male_mean - female_mean)

    assert np.isclose(observed_statistic_ab, expected, atol=1e-6), (
        f"observed_statistic_ab = {observed_statistic_ab}, "
        f"but should be |{male_mean:.3f} – {female_mean:.3f}| = {expected:.6f}"
    )
