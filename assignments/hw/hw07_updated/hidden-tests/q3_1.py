from otter.test_files import test_case
import numpy as np
from datascience import Table

OK_FORMAT = False
name = "q3_1"
points = 4

@test_case(points=4, hidden=True)
def test_q3_1(num_females):
    """
    Q3.1: number of females in the sample.
    The test loads age.csv directly and recomputes the correct count.
    """
    sampled_ages = Table.read_table("age.csv")
    
    
    true_count = sampled_ages.where("Gender", "female").num_rows
    
   
    assert isinstance(num_females, (int, np.integer)), "num_females must be an integer."
    assert num_females == true_count, (
        f"num_females = {num_females}, but the table contains {true_count} females."
    )
