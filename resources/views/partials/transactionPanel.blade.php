  <div class="table-responsive">
                        <table class="table table-hover table-striped">
                           

                            <tr class="table-heading bold">
                                <td>Date</td>
                                <td>Description</td>
                                <td>Amount</td>
                                <td>Category</td>
                            </tr>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date->format('m/d/y')  }}</td>
                                <td>{{ $transaction->description }}
                                    @if(count($team->users) >= 2)
                                        <br>
                                        <small><em>added by <a href="{{ route('dashboard', [$team, 'user_id' => $transaction->user_id] + Request::all()) }}">{{ $transaction->user->name }}</a></em></small>
                                    @endif
                                </td>
                                <td>{{ number_format($transaction->amount, 2) }}</td>
                                <td><a href="{{ route('dashboard', [$team, 'category_id' => $transaction->category_id] + Request::all()) }}">{{ $transaction->category->title or "None" }}</a> <a href="{{ route('transaction.edit', $transaction) }}" class="pull-right"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>