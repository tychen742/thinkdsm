from otter.test_files import test_case
import numbers, numpy as np, math

OK_FORMAT = False
name = "q3_8"
points = 7

P_HAT  = 0.525
POP_SD = math.sqrt(P_HAT * (1 - P_HAT))
MICHELLE_N  = 9975

@test_case(points=2, hidden=True)
def test_q3_8_sizes(larger_sample_size, michelle_sample_size=MICHELLE_N):
    assert isinstance(larger_sample_size, numbers.Number), \
        "`larger_sample_size` must be numeric."
    assert larger_sample_size > michelle_sample_size, \
        "`larger_sample_size` should exceed 9975."

@test_case(points=5, hidden=True)
def test_q3_8_sd(larger_sample_size, larger_sample_mean_sd,
                 michelle_sample_mean_sd):
    target = POP_SD / math.sqrt(larger_sample_size)
    assert np.isclose(larger_sample_mean_sd, target, atol=5e-4, rtol=0.05), \
        "Computed SD doesn’t match formula."
    assert larger_sample_mean_sd < michelle_sample_mean_sd - 1e-4, \
        "SD should be smaller than Michelle’s (smaller SE for larger n)."



#for those who use 10000 :

# @test_case(points=5, hidden=True)
# def test_q3_8_sd(larger_sample_size, larger_sample_mean_sd,
#                  michelle_sample_mean_sd):
#     # Verify the formula was applied correctly
#     assert isinstance(larger_sample_mean_sd, numbers.Number)
#     expected = POP_SD / math.sqrt(larger_sample_size)
#     assert np.isclose(larger_sample_mean_sd, expected, atol=5e-4, rtol=0.05), \
#         "Computed SD doesn’t match σ / √n formula."
#     # Accept any n > Michelle’s (even n=10000) as long as SE decreases
#     assert larger_sample_mean_sd < michelle_sample_mean_sd, \
#         "Sample mean SD must be smaller than Michelle's when n increases."