<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        <h3 class="text-xl md:text-3xl text-center font-bold mb-4 md:mb-6">Câu hỏi thường gặp</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6">
            <div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Khi nào tôi nhận được hàng?</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Thông thường đơn hàng sẽ được vận chuyển sau khi đơn hàng được xác nhận.</p>
                        <p>Bạn có thể xem trạng thái đơn hàng, hình ảnh hoặc link vận chuyển trong quản lý đơn hàng.</p>
                    </div>
                </div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Tôi muốn liên hệ với CSKH!</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Dịch vụ khách hàng trực 24/24. Quý khách có thể liên hệ qua Telegram, Fanpage Facebook và TikTok.</p>
                        <p>Hoặc gọi điện tới số Hotline để trên website. Xin cảm ơn</p>
                    </div>
                </div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Tại sao tôi nên liên kết tài khoản Telegram của mình?</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Đây không phải là liên kết tài khoản mà chúng tôi chỉ cần bạn cung cấp ID tài khoản Telegram.</p>
                        <p>Việc liên kết ID Telegram giúp bạn nhận thông tin đơn hàng, chat với CSKH thuận tiện và kịp thời hơn.</p>
                        <p>Chúng tôi không lưu bất cứ thông tin nào về tài khoản của bạn ngoại trừ ID Telegram.</p>
                    </div>
                </div>
            </div>
            <div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Ship COD và Thanh toán chuyển khoản là gì?</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Đây là 2 phương thức thanh toán đang được Nhà Thuốc Manila hỗ trợ.</p>
                        <p>Ship COD là hình thức khách hàng nhận hàng và thanh toán tiền cho shipper, phương thức này đảm bảo khách hàng nhận đúng và đủ hàng trước khi thanh toán, nhưng phí ship sẽ cao hơn so với hình thức Chuyển khoản.</p>
                        <p>Thanh toán chuyển khoản là hình thức khách hàng thanh toán tiền hàng bằng cách chuyển khoản vào tài khoản của Nhà Thuốc Manila, phương thức này thuận tiện khi khách hàng không có tiền mặt hoặc muốn giảm chi phí ship và nhận ưu đãi.</p>
                    </div>
                </div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Tôi có thể đến tận nơi mua hàng không?</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Hiện tại Nhà Thuốc Manila chỉ bán online.</p>
                        <p>Quý khách hãy yên tâm vì chúng tôi có bác sĩ tư vấn trước khi kê đơn, sẵn sàng đổi trả nếu phát hiện có vấn đề.</p>
                    </div>
                </div>
                <div x-data="{ expanded: false }" class="py-2 px-4 rounded bg-gray-100 mb-4">
                    <div x-on:click="expanded = ! expanded" class="flex justify-between font-semibold cursor-pointer md:py-2">
                        <p>Tôi muốn theo dõi đơn hàng của mình?</p>
                        <i x-show="!expanded" class="fa-solid fa-plus"></i>
                        <i x-show="expanded" class="fa-solid fa-minus"></i>
                    </div>
                    <div x-show="expanded" x-collapse.duration.500ms class="text-sm mt-2 p-2 bg-white">
                        <p>Sau khi đơn hàng được vận chuyển chúng tôi sẽ cập nhật trạng thái đơn hàng và link theo dõi cũng như số điện thoại shipper,</p>
                        <p>Quý khách có thể xem trong phần thông tin "Đơn hàng của bạn".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
