<td width="20%">
    <div>

        <select class="form-control @error('member_id') is-invalid @enderror"
                name="member_id" id="member_id" wire:model="member_id" required>
            <option value="" selected>{{ 'Choose Member' }}</option>

            @foreach($members as $member)
                <option
                    value="{{ $member->id}}">{{ $member->fname.' '.$member->lname }}</option>
            @endforeach

        </select>

        @error('member_id')
        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
        @enderror
    </div>
</td>
<td width="20%">

    <div>


        <select
            class="form-control  @error('invoice_id') is-invalid @enderror"
            wire:model="invoices" name="invoice_id" id="invoice_id" required>
            <option value="" selected>{{ 'Choose Invoice No' }}</option>

            @foreach($invoices as $invoice)
                <option
                    value="{{ $invoice->id}}">{{ $invoice->id }}</option>
            @endforeach


        </select>

        @error('invoices_id')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror

    </div>
</td>
