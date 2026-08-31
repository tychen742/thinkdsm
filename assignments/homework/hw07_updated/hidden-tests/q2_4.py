from otter.test_files import test_case

OK_FORMAT = False
name = "q2_4"
points = 4

@test_case(points=4, hidden=True)
def test_q2_4_pvalue(p_value_tvd):
    assert p_value_tvd < 0.05, f"Expected p_value_tvd to be less than 0.05, but got {p_value_tvd}"
