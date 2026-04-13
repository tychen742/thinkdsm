from otter.test_files import test_case

OK_FORMAT = False
name = "q3_5"
points = 4

@test_case(points=4, hidden=True)
def test_q3_5(correct_test_stat):
  
    assert correct_test_stat in {1, 2}, (
        "correct_test_stat must be 1 or 2."
    )
