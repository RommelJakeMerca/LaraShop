@extends('products.products_index')

@section('titlePage', 'LegaShop | Rewards');
@section('content')

<!-- REWARDS CONTAINER -->
<div class="container transaction-container">
    <div class="row">
    @include('products.account_nav')
        <div class="col-md-8 rewards-info">
            <h3 class="rewards-title">
                My Rewards
            </h3>
            
            @if($currentValue)
                <h3 class="reward-points">
                    <i class="fas fa-gifts"></i> 
                    {{$currentValue}} Reward Points
                </h3>
            @else
                <h3 class="reward-points">
                    <i class="fas fa-gifts"></i> 
                   0 Reward Point
                </h3>
            @endif

            <i class="fas fa-gifts earn-more-gifts"></i>
            <h4><a href="#" class="earn-more">
                Earn more rewards
                <i class="fas fa-angle-double-right earn-right"></i>
                </a>
            </h4>
            <b class="how-rewards">How it works?</b>
            <ul class="rewards-list mt-1">
                <li>
                    <b>1 reward point</b> is equivalent to <b>1 Rial.</b>
                </li>
                <li>
                    Earn points through <b>Legashop: Wheel of Fortune</b>
                </li>
                <li>
                    Earn points to exchange as ticket to join the raffle.
                </li>
                <li>
                    Buy any products at <b>legaShop</b> store can earn more points.
                </li>
            </ul>

            <h5 class="reward-points-table-name mt-4">Reward Points History</h5>
            <div class="table-responsive">
                <table class="table rewards-table-container">
                    <thead style="background-color:#F7AB07;">
                      <tr>
                        <th>REWARD TITLE</th>
                        <th>RECEIVED DATE</th>
                        <th>EARNING</th>
                        <th>SPENDING</th>
                        <th>EXPIRATION DATE</th>
                      </tr>
                    </thead>
                    @foreach($rewardPaginates as $rewardPaginate)
                        <tbody>
                            <tr>
                                <td class="reward-title-table">{{$rewardPaginate->title}}</td>
                                <td class="reward-received-table">{{$rewardPaginate->original_date->format('F d, Y ')}}</td>
                                <td class="reward-earning-table">{{$rewardPaginate->reward_points}}</td>
                                <td class="reward-spending-table">IN PROGRESS</td>
                                <td class="reward-expiration-table" class>{{$rewardPaginate->expiration_date->format('F d, Y ')}}</td>
                            </tr>
                        </tbody>
                    @endforeach            
                </table>
                
            @if(!$rewardPaginates[0])
                <p class="no-reward-points-history">No reward points history yet.</p>
            @endif

                <div class="rewards-pagination">
                    {{$rewardPaginates->links('/vendor/pagination/rewards-pagination')}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

<script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
<script>
    $('#search-bar').hide();
        $('.search-icon').hide();
</script>
@endsection