<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <table class="table table-bordered">
            <th colspan="2" class="text-center">
                {{ $cat_name }}~~| ω・´)
            </th>
            </thead>
            <tbody>
            <form method="POST" action = "{{ Request::server('REQUEST_URI') }}"class="form-control">
                {{ csrf_field() }}
                <tr>
                    <td>
                        Post your content(At least 15 chars)
                    </td>
                    <td>
                        <textarea name="content"> </textarea>
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