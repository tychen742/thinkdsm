from otter.test_files import test_case

OK_FORMAT = False
name = "q2_5"
points = 0.75


@test_case(points=0.75, hidden=True)
def test_q2_5(cutoff_ten_percent):
    
    assert cutoff_ten_percent == 1, (
        f"Expected cutoff_ten_percent to be 1 (reject the null), but got {cutoff_ten_percent}"
    )
