from otter.test_files import test_case

OK_FORMAT = False
name = "q3_9"
points = 5

@test_case(points=5, hidden=True)
def test_q3_9_bool(min_sufficient):
    assert min_sufficient is True, \
        "Given the target SD (0.005) and Michelle’s n = 9 975, the answer should be True."
