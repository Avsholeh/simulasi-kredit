<?php

namespace MathPHP\Tests\Statistics;

use MathPHP\Statistics\Correlation;
use MathPHP\Exception;

class CorrelationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test         covariance - population covariance
     * @dataProvider dataProviderForPopulationCovariance
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testCovariancePopulation(array $X, array $Y, float $expected)
    {
        // When
        $covariance = Correlation::covariance($X, $Y, true);

        // Then
        $this->assertEquals($expected, $covariance, '', 0.01);
    }

    /**
     * @test         populationCovariance
     * @dataProvider dataProviderForPopulationCovariance
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testPopulationCovariance(array $X, array $Y, float $expected)
    {
        // When
        $covariance = Correlation::populationCovariance($X, $Y);

        // Then
        $this->assertEquals($expected, $covariance, '', 0.01);
    }

    /**
     * Data provider for population covariance test
     * @return array [X, Y, covariance]
     */
    public function dataProviderForPopulationCovariance(): array
    {
        return [
            [ [ 1, 2, 3, 4 ], [ 2, 3, 4, 5 ], 1.25 ],
            [ [ 1, 2, 4, 7, 9, 10 ], [ 2, 3, 5, 8, 11, 12.5 ], 13.29167 ],
            [ [ 1, 3, 2, 5, 8, 7, 12, 2, 4], [ 8, 6, 9, 4, 3, 3, 2, 7, 7 ], -7.1728 ],
        ];
    }

    /**
     * @test         weightedCovariance
     * @dataProvider dataProviderForWeightedCovariance
     * @param        array $X
     * @param        array $Y
     * @param        array $w
     * @param        float $expected
     * @throws       \Exception
     */
    public function testWeightedCovariance(array $X, array $Y, array $w, float $expected)
    {
        // When
        $covariance = Correlation::weightedCovariance($X, $Y, $w);

        // Then
        $this->assertEquals($expected, $covariance, '', 0.001);
    }

    /**
     * Data provider for weighted covariance test
     * @return array [X, Y, w, covariance]
     */
    public function dataProviderForWeightedCovariance(): array
    {
        return [
            [ [ 1, 2, 3, 4 ], [ 2, 3, 4, 5 ], [ 1, 1, 1, 1 ], 1.25 ],
            [ [ 1, 2, 4, 7, 9, 10 ], [ 2, 3, 5, 8, 11, 12.5 ],  [ 1.0, 1, 1, 1, 1, 1 ], 13.29167 ],
            [ [ 1, 3, 2, 5, 8, 7, 12, 2, 4], [ 8, 6, 9, 4, 3, 3, 2, 7, 7 ], [ 1, 1, 1, 1, 1, 1, 1, 1, 1 ], -7.1728 ],
            [ [1.4, 1.9, 2.6, 0.3, 0.3, 0.8, 1, 2.5, 2.9, 0.9], [2.6, 3, 1.4, 1.5, 2.8, 1.9, 1.9, 0.6, 2.0, 2.1], [0.87, 0.68, 0.69, 0.83, 0.17, 0.56, 0.01, 0.79, 0.26, 0.72], -0.179768 ],
            [ [9, 18, 10, 29, 22], [2, 11, 5, 12, 21], [8, 15, 10, 0, 6], 29.0178]
        ];
    }

    /**
     * @test         weightedCovariance throws a BadDataException if the counts of any of the arrays are different
     * @dataProvider dataProviderForWeightedCovarianceException
     * @param        array $X
     * @param        array $Y
     * @param        array $w
     * @throws       Exception\BadDataException
     */
    public function testWeightedCovarianceException(array $X, array $Y, array $w)
    {
        // Then
        $this->expectException(Exception\BadDataException::class);

        // When
        Correlation::weightedCovariance($X, $Y, $w);
    }

    /**
     * @return array [X, Y, weights]
     */
    public function dataProviderForWeightedCovarianceException(): array
    {
        return [
            [
                [1, 2, 3],
                [2, 3],
                [1, 1, 1],
            ],
            [
                [1, 2, 3],
                [2, 3, 4],
                [1, 1,],
            ],
        ];
    }

    /**
     * @test     populationCovariance when X and Y have different counts
     * @throws   \Exception
     */
    public function testPopulationCovarianceExceptionWhenXAndYHaveDifferentCounts()
    {
        // Then
        $this->expectException(Exception\BadDataException::class);

        // When
        Correlation::populationCovariance([ 1, 2 ], [ 2, 3, 4 ]);
    }

    /**
     * @test         covariance - sample covariance
     * @dataProvider dataProviderForSampleCovariance
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testCovarianceSample(array $X, array $Y, float $expected)
    {
        // When
        $covariance = Correlation::covariance($X, $Y);

        // Then
        $this->assertEquals($expected, $covariance, '', 0.01);
    }

    /**
     * @test         sampleCoveriance
     * @dataProvider dataProviderForSampleCovariance
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testSampleCovariance(array $X, array $Y, float $expected)
    {
        // When
        $covariance = Correlation::sampleCovariance($X, $Y);

        // Then
        $this->assertEquals($expected, $covariance, '', 0.01);
    }

    /**
     * Data provider for sample covariance test
     * @return array [X, Y, covariance]
     */
    public function dataProviderForSampleCovariance(): array
    {
        return [
            [ [ 1, 2, 3, 4 ], [ 2, 3, 4, 5 ], 1.66667 ],
            [ [ 1, 2, 4, 7, 9, 10 ], [ 2, 3, 5, 8, 11, 12.5 ], 15.95 ],
            [ [ 1, 3, 2, 5, 8, 7, 12, 2, 4], [ 8, 6, 9, 4, 3, 3, 2, 7, 7 ], -8.0694 ],
        ];
    }

    /**
     * @test     sampleCovariance when X and Y have different counts
     * @throws   \Exception
     */
    public function testSampleCovarianceExceptionWhenXAndYHaveDifferentCounts()
    {
        // Then
        $this->expectException(Exception\BadDataException::class);

        // When
        Correlation::sampleCovariance([ 1, 2 ], [ 2, 3, 4 ]);
    }

    /**
     * @test         r - poluation
     * @dataProvider dataProviderForPopulationCorrelationCoefficient
     * @param        array $x
     * @param        array $y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testRPopulation(array $x, array $y, float $expected)
    {
        // When
        $r = Correlation::r($x, $y, true);

        // Then
        $this->assertEquals($expected, $r, '', 0.0001);
    }

    /**
     * @test         populationCorrelationCoefficient
     * @dataProvider dataProviderForPopulationCorrelationCoefficient
     * @param        array $x
     * @param        array $y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testPopulationCorrelationCoefficient(array $x, array $y, float $expected)
    {
        // When
        $pcc = Correlation::populationCorrelationCoefficient($x, $y);

        // Then
        $this->assertEquals($expected, $pcc, '', 0.0001);
    }

    /**
     * Data provider for population correlation coefficient test
     * @return array [x, y, ppc]
     */
    public function dataProviderForPopulationCorrelationCoefficient(): array
    {
        return [
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 40, 80, 100 ], 0.96841 ],
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 30, 50, 120 ], 0.96359 ],
        ];
    }

    /**
     * @test         weightedCorrelationCoefficient
     * @dataProvider dataProviderForWeightedCorrelationCoefficient
     * @param        array $x
     * @param        array $y
     * @param        array $w
     * @param        float $expected
     * @throws       \Exception
     */
    public function testWeightedCorrelationCoefficient(array $x, array $y, array $w, float $expected)
    {
        // When
        $wcc = Correlation::weightedCorrelationCoefficient($x, $y, $w);

        // Then
        $this->assertEquals($expected, $wcc, '', 0.00001);
    }

    /**
     * Data provider for weighted correlation coefficient test
     * Test data created using R package wCorr: weightedCorr(x, y, weights = w, method = "Pearson")
     * @return array [x, y, w, wcc]
     */
    public function dataProviderForWeightedCorrelationCoefficient(): array
    {
        return [
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 40, 80, 100 ], [1, 1, 1, 1, 1], 0.9684134 ],
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 30, 50, 120 ], [1, 1, 1, 1, 1], 0.963586 ],
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 30, 50, 120 ], [0.2, 0.3, 0.2, 0.2, 0.1], 0.9510173 ],
            [ [1.1, 1.6, 1.7, 2.3, 1.3], [1.7, 0.5, 1.7, 0.3, 1.2], [1.14, 0.88, 0.64, 1.78, 1.64], -0.8127747],
            [[9, 18, 10, 29, 22], [2, 11, 5, 12, 21], [8, 15, 10, 0, 6], 0.9490861]
        ];
    }

    /**
     * @test         r - sample
     * @dataProvider dataProviderForSampleCorrelationCoefficient
     * @param        array $x
     * @param        array $y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testRSample(array $x, array $y, float $expected)
    {
        // When
        $scc = Correlation::r($x, $y);

        // Then
        $this->assertEquals($expected, $scc, '', 0.0001);
    }

    /**
     * @test         sampleCorrelationCoefficient
     * @dataProvider dataProviderForSampleCorrelationCoefficient
     * @param        array $x
     * @param        array $y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testSampleCorrelationCoefficient(array $x, array $y, float $expected)
    {
        // When
        $scc = Correlation::sampleCorrelationCoefficient($x, $y);

        // Then
        $this->assertEquals($expected, $scc, '', 0.0001);
    }

    /**
     * Data provider for sample correlation coefficient test
     * @return array [x, y, ppc]
     */
    public function dataProviderForSampleCorrelationCoefficient(): array
    {
        return [
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 40, 80, 100 ], 0.9684 ],
            [ [ 1, 2, 4, 5, 8 ], [ 5, 20, 30, 50, 120 ], 0.9636 ],
        ];
    }

    /**
     * @test         coefficientOfDetermination
     * @dataProvider dataProviderForR2
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testCoefficientOfDetermination(array $X, array $Y, float $expected)
    {
        // When
        $r2 = Correlation::coefficientOfDetermination($X, $Y);

        // Then
        $this->assertEquals($expected, $r2, '', 0.001);
    }

    /**
     * @test         r2
     * @dataProvider dataProviderForR2
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testR2(array $X, array $Y, float $expected)
    {
        // When
        $r2 = Correlation::r2($X, $Y);

        // Then
        $this->assertEquals($expected, $r2, '', 0.001);
    }

    /**
     * @return array [X, Y, r2]
     */
    public function dataProviderForR2(): array
    {
        return [
            [
                [1,2,4,5,6],
                [2,3,5,7,8],
                0.986049
            ],
            [
                [4,9,10,14,4,7,12,22,1,3,8,11,5,6,10,11,16,13,13,10,],
                [390,580,650,730,410,530,600,790,350,400,590,640,450,520,690,690,770,700,730,640],
                0.87160896
            ],
        ];
    }

    /**
     * @test         kendallsTau
     * @dataProvider dataProviderForKendallsTau
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testKendallsTau(array $X, array $Y, float $expected)
    {
        // When
        $τ = Correlation::kendallsTau($X, $Y);

        // Then
        $this->assertEquals($expected, $τ, '', 0.001);
    }

    /**
     * @return array [X, Y, τ]
     */
    public function dataProviderForKendallsTau(): array
    {
        return [
            // No ties for tau-a
            [
                [1, 2, 5, 3, 4],
                [1, 4, 2, 3, 5],
                0.2,
            ],
            [
                [2, 4, 7, 9],
                [4, 8, 7, 9],
                0.666667,
            ],
            [
                [5, 4, 3, 2],
                [4, 5, 6, 7],
                -1,
            ],
            [
                [85, 98, 90, 83, 57, 63, 77, 99, 80, 96, 69],
                [85, 95, 80, 75, 70, 65, 73, 93, 79, 88, 74],
                0.818,
            ],
            // Ties for tau-b
            [
                [4, 5, 5, 6, 5, 8],
                [4, 6, 7, 8, 7, 8],
                0.880705,
            ],
            [
                [12, 14, 14, 17, 19, 19, 19, 19, 19, 20, 21, 21, 21, 21, 21, 22, 23, 24, 24, 24, 26, 26, 27],
                [11, 4, 4, 2, 0, 0, 0, 0, 0, 0, 4, 0, 4, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0],
                -0.376201540231705,
            ],
            [
                [0.7, 0.8, 0.8, 0.8, 1.2, 1.3, 1.6, 1.8, 1.9, 2.4, 2.5, 2.7, 2.9, 2.9, 3.9, 5.8, 6.5, 7.9, 9.1],
                [300, 211, 227, 297, 199, 285, 207, 167, 266, 191, 211, 172, 131, 220, 167, 115, 86, 107, 71],
                -0.696
            ],
        ];
    }

    /**
     * @test     kendallsTau with different length arrays
     * @throws   \Exception
     */
    public function testKendallsTauExceptionDifferentLengthArrays()
    {
        // Given
        $X = [1, 2, 3];
        $Y = [2, 3, 4, 5];

        // Then
        $this->expectException(Exception\BadDataException::class);

        // When
        Correlation::kendallsTau($X, $Y);
    }

    /**
     * @test         spearmansRho
     * @dataProvider dataProviderForSpearmansRho
     * @param        array $X
     * @param        array $Y
     * @param        float $expected
     * @throws       \Exception
     */
    public function testSpearmansRho(array $X, array $Y, float $expected)
    {
        // When
        $ρ = Correlation::spearmansRho($X, $Y);

        // Then
        $this->assertEquals($expected, $ρ, '', 0.001);
    }

    /**
     * @return array [X, Y, ρ]
     */
    public function dataProviderForSpearmansRho(): array
    {
        return [
            [
                [56, 75, 45, 71, 62, 64, 58, 80, 76, 61],
                [66, 70, 40, 60, 65, 56, 59, 77, 67, 63],
                0.6727
            ],
            [
                [1, 2, 3, 4, 5],
                [2, 3, 4, 4, 6],
                0.975
            ],
            [
                [4, 10, 3, 1, 9, 2, 6, 7, 8, 5],
                [5, 8, 6, 2, 10, 3, 9, 4, 7, 1],
                0.6848
            ],
            [
                [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
                [26, 25, 18, 33, 70, 55, 50, 49, 70, 80, 76, 74, 73],
                0.8583
            ],
            [
                [1, 5, 2, 5, 2],
                [2, 2, 3, 1, 3],
                -0.325
            ]
        ];
    }

    /**
     * @test     spearmansRho with different length arrays
     * @throws   \Exception
     */
    public function testSpearmansRhoExceptionDifferentLengthArrays()
    {
        // Given
        $X = [1, 2, 3];
        $Y = [2, 3, 4, 5];

        // Then
        $this->expectException(Exception\BadDataException::class);

        // When
        Correlation::spearmansRho($X, $Y);
    }

    /**
     * @test     describe
     * @throws   \Exception
     */
    public function testDescribe()
    {
        // Given
        $X = [1, 2, 3, 4, 5];
        $Y = [2, 3, 4, 4, 6];

        // When
        $stats = Correlation::describe($X, $Y);

        // Then
        $this->assertTrue(is_array($stats));
        $this->assertArrayHasKey('cov', $stats);
        $this->assertArrayHasKey('r', $stats);
        $this->assertArrayHasKey('r2', $stats);
        $this->assertArrayHasKey('tau', $stats);
        $this->assertArrayHasKey('rho', $stats);
        $this->assertTrue(is_numeric($stats['cov']));
        $this->assertTrue(is_numeric($stats['r']));
        $this->assertTrue(is_numeric($stats['r2']));
        $this->assertTrue(is_numeric($stats['tau']));
        $this->assertTrue(is_numeric($stats['rho']));
    }

    /**
     * @test         confidenceEllipse
     * @dataProvider dataProviderForEllipse
     * @param        array $data
     * @param        float $sd
     * @param        array $results
     * @throws       \Exception
     */
    public function testEllipse(array $data, float $sd, array $results)
    {
        // When
        $calc = Correlation::confidenceEllipse(array_column($data, 0), array_column($data, 1), $sd);

        // Then
        $this->assertEquals($results, $calc, '', 0.0001);
    }

    /**
     * @return array [data, sd, results]
     */
    public function dataProviderForEllipse(): array
    {
        return [
            [
                [
                    [1.00787, 1.09905],
                    [1.23724, 0.98834],
                    [1.02175, 0.67245],
                    [0.88458, 0.36003],
                    [0.66582, 1.22097],
                    [1.24408, 0.59735],
                    [1.03421, 0.88595],
                    [1.66279, 0.84183],
                ],
                1,
                [
                    [1.47449429236742, 0.555004169940273],
                    [1.54091626950741, 0.797745563446301],
                    [1.43693412988479, 1.05404701259189],
                    [1.20226551661247, 1.22601007516927],
                    [0.926545863867666, 1.24795070608341],
                    [0.71509070763258, 1.11148833005973],
                    [0.648668730492593, 0.868746936553699],
                    [0.752650870115211, 0.612445487408114],
                    [0.987319483387533, 0.440482424830733],
                    [1.26303913613233, 0.418541793916591],
                    [1.47449429236742, 0.555004169940273],
                ],
            ],
        ];
    }
}
