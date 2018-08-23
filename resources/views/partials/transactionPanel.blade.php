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
                                <td>{{ $transaction->description }}</td>
                                <td>{{ number_format($transaction->amount, 2) }}</td>
                                <td><a href="{{ route('category.viewBy', $transaction->category) }}">{{ $transaction->category->title or "None" }}</a> <a href="{{ route('transaction.edit', $transaction) }}" class="pull-right"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>