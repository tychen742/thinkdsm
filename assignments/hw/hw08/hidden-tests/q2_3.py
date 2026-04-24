from otter.test_files import test_case

OK_FORMAT = False
name = "q2_3"  
points = 0.75


@test_case(points=0.75, hidden=True)
def test_q2_3_cutoff(cutoff_five_percent):
    assert cutoff_five_percent == 1, (
        f"Expected cutoff_five_percent to be 1 (reject the null), but got {cutoff_five_percent}"
    )
