from otter.test_files import test_case

OK_FORMAT = False
name = "q3_8"
points = 4

@test_case(points=4, hidden=True)
def test_q3_8(correct_q8):
    """
    The comparison `comp = (count of 'female' in shuffled_labels) == num_females`
    is **always True**, because shuffled_labels is a permutation that keeps the
    same number of females.  So the correct letter is 'A'.
    """
    assert correct_q8 == 'A', (
        f"correct_q8 should be 'A' (comp is always True), not {correct_q8!r}."
    )
