<?php

use Illuminate\Support\Facades\Route;
use Modules\ConvenioIPM\Http\Controllers\ConvenioIPMController;

Route::prefix('convenio-ipm')->group(function () {
    /*
     * WUNPessoa
     */
    Route::post('/getPessoa', [ConvenioIPMController::class, 'getPessoa']);
    Route::post('/getPessoaBasico', [ConvenioIPMController::class, 'getPessoaBasico']);
    Route::post('/getPessoaFisica', [ConvenioIPMController::class, 'getPessoaFisica']);
    Route::post('/importaPessoa', [ConvenioIPMController::class, 'importaPessoa']);
    Route::post('/importaPessoaFisica', [ConvenioIPMController::class, 'importaPessoaFisica']);

    /*
     * WGTLancamentoTributario
     */
    Route::post('/insereLancamentoTributarioExercicio', [ConvenioIPMController::class, 'insereLancamentoTributarioExercicio']);
    Route::post('/cancelaParcelaLancamentoTributario', [ConvenioIPMController::class, 'cancelaParcelaLancamentoTributario']);
    Route::post('/alteraValoresParcela', [ConvenioIPMController::class, 'alteraValoresParcela']);
    Route::post('/calculoTributarioIndividual', [ConvenioIPMController::class, 'calculoTributarioIndividual']);
    Route::post('/insereReparcelamentoLancamentoTributario', [ConvenioIPMController::class, 'insereReparcelamentoLancamentoTributario']);
    Route::post('/cancelaReparcelamentoLancamentoTributario', [ConvenioIPMController::class, 'cancelaReparcelamentoLancamentoTributario']);
    Route::post('/estornaCancelamentoParcelaLancamentoTributario', [ConvenioIPMController::class, 'estornaCancelamentoParcelaLancamentoTributario']);
    Route::post('/buscaSituacaoParcela', [ConvenioIPMController::class, 'buscaSituacaoParcela']);
    Route::post('/buscaLancamentosTributarios', [ConvenioIPMController::class, 'buscaLancamentosTributarios']);
    Route::post('/emiteCarne', [ConvenioIPMController::class, 'emiteCarne']);
    Route::post('/buscaDadosCarne', [ConvenioIPMController::class, 'buscaDadosCarne']);
});
