from otter.test_files import test_case
import numpy as np, numbers

OK_FORMAT = False
name  = "q2_2"
points = 5


@test_case(points=5, hidden=True)
def test_q2_2_value(r_guess):
    
    assert r_guess in {0, -0.75}, (
        "`r_guess` should be either 0 or -0.75."
    )
