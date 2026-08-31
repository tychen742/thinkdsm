from otter.test_files import test_case

OK_FORMAT = False
name = "q3_4"
points = 4

@test_case(points=4, hidden=True)
def test_q3_4(permutation_test_reason):
    """
    Acceptable answers for the reason to use a permutation test:

      1. Independence wording – “age shouldn’t be related to gender, so labels can be shuffled”.
      2. Null-model wording – “under the null, shuffling labels is equivalent to drawing
         a new sample with the same male/female counts”.

  
    """
    assert permutation_test_reason in {1, 2}, (
        "permutation_test_reason must be 1 or 2."
    )
