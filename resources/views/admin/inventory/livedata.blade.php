
<thead>
    <tr>
        <th>S.No</th>
        <th>Dropshipper</th>
        <th>FTP Folder</th>
        <th>Total</th> 
        <th>Today Update Count</th>
        <th>Started At</th>
        <th>Last Update</th>
    </tr>
</thead>  
<tbody id="livereportTableBody">
    <?php $i=1; ?>
    @forelse(@$liveData['dropshippers'] as $dropshipper => $count) 
    <tr> 
        <td>{{@$i++}}</td>
        <td>{{@$dropshipper}}</td>
        <td>{{getFTPfolders(@$dropshipper)}}</td>
        <td>{{@$count}}</td>  
        <td>{{@$liveData['today_dropshippers'][$dropshipper]??0}}</td>
        <td>{{@$liveData['starttime_dropshippers'][$dropshipper]??'-'}}</td>
        <td>{{@$liveData['lasttime_dropshippers'][$dropshipper]??'-'}}</td>
    </tr>
    @empty 
    @endforelse
     
    <tr> 
        <td colspan="3">Total</td> 
        <td>{{@$liveData['total']}}</td>  
        <td colspan="2">-</td> 
    </tr> 

</tbody>
