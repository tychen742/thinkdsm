from otter.test_files import test_case

OK_FORMAT = False
name = "q1_9"
points = 4

@test_case(points=4, hidden=True)
def test_q1_9(correct_doctor):
    """
    Q1.9: Doctor Sahai (choice 2) is better supported when the
    p-value is below 0.05.
    """
    expected = 2
    assert correct_doctor == expected, (
        f"correct_doctor should be {expected} (Dr. Sahai), but got {correct_doctor}."
    )
