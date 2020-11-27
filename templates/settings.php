<div class="wrap">
    <h1>Npaste settings</h1>
    <form novalidate="novalidate">
        <table class="form-table" role="presentation">
            <tr>
                <th scope="row">
                    <label for="npaste_age">Age</label>
                </th>
                <td>
                    <input name="npaste_age" id="npaste_age" type="text" class="regular-text">
                    <p class="description">Paste age (s,m,h,d,y)</p>
                </td>
            </tr>
            <tr>
                <th scope="row">Archive</th>
                <td>
                    <label for="npaste_archive">
                        <input name="npaste_archive" type="checkbox" id="npaste_archive">
                        If a paste should be archived instead of deleted when expiring.
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row">Encrypt</th>
                <td>
                    <label for="npaste_encrypt">
                        <input name="npaste_encrypt" type="checkbox" id="npaste_encrypt">
                        If a paste should be encrypted using GPG.
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="npaste_encryption_key_length">Encryption key length</label>
                </th>
                <td>
                    <input name="npaste_encryption_key_length" id="npaste_encryption_key_length" type="number">
                    <p class="description">The length of the encryption key.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="npaste_password">Password</label>
                </th>
                <td>
                    <input name="npaste_password" id="npaste_password" type="password" class="regular-text">
                    <p class="description">Your API password.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="npaste_url">URL</label>
                </th>
                <td>
                    <input name="npaste_url" id="npaste_url" type="text" class="regular-text">
                    <p class="description">The URL for the npaste server to use.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="npaste_username">Username</label>
                </th>
                <td>
                    <input name="npaste_username" id="npaste_username" type="text" class="regular-text">
                    <p class="description">Your API username.</p>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button button-primary" value="Save changes">
        </p>
    </form>
</div>
