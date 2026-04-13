# chatgpt


from otter.test_files import test_case
import numpy as np
from collections import Counter
from datascience import Table

OK_FORMAT = False
name = "q3_7"
points = 4

########################################
# 1. Structural check (0.5 pt)         #
########################################
@test_case(points=2, hidden=True)
def test_q3_7_shape(shuffled_labels):
    sampled_ages = Table.read_table("age.csv")
    n = sampled_ages.num_rows

    assert isinstance(shuffled_labels, np.ndarray), \
        "shuffled_labels must be a NumPy array."
    assert shuffled_labels.shape == (n,), \
        f"shuffled_labels should have length {n}; got shape {shuffled_labels.shape}."

########################################
# 2. Valid permutation check (0.5 pt)  #
########################################
@test_case(points=2, hidden=True)
def test_q3_7_permutation(shuffled_labels):
    sampled_ages = Table.read_table("age.csv")
    original = sampled_ages.column("Gender")

    # They must contain exactly the same multiset of labels
    assert Counter(shuffled_labels) == Counter(original), (
        "shuffled_labels must contain the same number of 'male' and 'female' "
        "entries as the original Gender column."
    )

    # Very unlikely they left the order unchanged – warn if identical
    assert not np.array_equal(shuffled_labels, original), (
        "shuffled_labels is identical to the original Gender column; "
        "it should be randomly permuted."
    )
