from otter.test_files import test_case
import numpy as np
from datascience import Table

OK_FORMAT = False
name = "q3_2"
points = 4

@test_case(points=4, hidden=True)
def test_q3_2(avg_male_vs_female):
    """
    Q3.2: avg_male_vs_female should be True iff the mean age of
    sampled males exceeds the mean age of sampled females.
    """
    sampled_ages = Table.read_table("age.csv")

    male_mean   = sampled_ages.where("Gender", "male").column("Age").mean()
    female_mean = sampled_ages.where("Gender", "female").column("Age").mean()
    correct_answer = male_mean > female_mean

    assert isinstance(avg_male_vs_female, (bool, np.bool_)), (
        "avg_male_vs_female should be True or False."
    )
    assert avg_male_vs_female == correct_answer, (
        f"avg_male_vs_female is {avg_male_vs_female}, but the male mean age "
        f"({male_mean:.2f}) {'>' if male_mean>female_mean else '<='} female mean age "
        f"({female_mean:.2f})."
    )
