<table class="table table-condensed table-striped table-responsive-sm" id="statement">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Doc No</th>
            <th scope="col">Category</th>
            <th scope="col">Owed[KES]</th>
            <th scope="col">Paid[KES]</th>
            <th scope="col">R-Balacnce[KES]</th>
        </tr>
    </thead>
    <tbody>
        @php
        $debit= $balBF['debit'];
        $credit= $balBF['credit'];
        $tcredit=$balBF['credit'];
        $tdebit=$balBF['debit'];
        $balance=abs($balBF['credit']-$balBF['debit']);
        @endphp
        <tr>
            <th></th>
            <th></th>
            <th>B/F</th>
            <th>{{ number_format($debit,2) }}</th>
            <th>{{ number_format($credit,2) }}</th>
            <th>{{ number_format($balance,2) }}</th>
        </tr>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{$transaction->date}}</td>
            <td><a href="{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'credit' : 'payment') : 'invoice').'/'.$transaction->docno}}">
                    <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span>
                </a>{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'CRD' : 'RCT') : 'INV').$transaction->docno}}</td>
            <td>{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'CRD' : 'RCT') : 'INV') }}</td>
            <td>{{ number_format($debit=$transaction->owed, 2) }}</td>
            <td>{{ ($transaction->credit!=0 ? number_format($credit=$transaction->credit, 2) : number_format($credit=$transaction->paid, 2) ) }}</td>
            <td>
                @php

                $tdebit+=$debit;
                $tcredit+=$credit;
                $balance= abs($tdebit-$tcredit);
                @endphp
                {{ number_format($balance,2) }}
            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ number_format($tdebit,2) }}</th>
            <th>{{ number_format($tcredit,2) }}</th>
            <th>{{ number_format($balance,2) }}</th>
        </tr>
    </tfoot>
    </tfoot>
    </tbody>

</table>