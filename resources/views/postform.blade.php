<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <table class="table table-bordered">
            <th colspan="2" class="text-center">
                {{ $cat_name }}~~| ω・´)
            </th>
            </thead>
            <tbody>
            <form method="POST" action = "{{ Request::server('REQUEST_URI') }}"class="form-control" enctype="multipart/form-data">
                {{ csrf_field() }}
                <tr>
                    <td>
                        Post your content<br/><strong>(At least 15 chars)</strong>
                    </td>
                    <td>
                        <textarea name="content" style="height: 100px;width: 350px"> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Choose a Picture
                    </td>
                    <td>
                        <input type="file" name="file"/>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <input type="submit" name="submit" value="Submit"/>
                        <input class="col-lg-offset-7" type="reset" name="reset" value="Clear"/>
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>
</div>